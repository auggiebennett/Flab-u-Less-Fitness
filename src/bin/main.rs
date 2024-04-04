use std::net::TcpListener;
use std::net::TcpStream;
use std::io::prelude::*;
use std::fs;
use mysql::prelude::*;
use mysql::{Pool, PooledConn};
use mtr_server_app::ThreadPool;

fn main() {
    let listener = TcpListener::bind("127.0.0.1:7878").unwrap();
    let pool = ThreadPool::new(4);
    let mysql_pool = establish_mysql_pool();

    for stream in listener.incoming() {
        let stream = stream.unwrap();

        let mysql_pool = mysql_pool.clone();
        pool.execute(move || {
            handle_connection(stream, &mysql_pool);
        });
    }
}

fn establish_mysql_pool() -> Pool {
    mysql::Pool::new("mysql://root:@localhost:3306/flabuless_fitness").unwrap()
}

fn handle_connection(mut stream: TcpStream, mysql_pool: &Pool) {
    let mut buffer = [0; 1024];
    stream.read(&mut buffer).unwrap();

    let request = std::str::from_utf8(&buffer).unwrap_or_default();
    let request_line = request.lines().next().unwrap_or_default();
    let request_parts: Vec<&str> = request_line.split_whitespace().collect();
    if request_parts.len() < 2 {
        return;
    }

    let requested_path = request_parts[1];
    let mut path = format!("public{}", requested_path);
    let status_line = if fs::metadata(&path).is_ok() {
        "HTTP/1.1 200 OK"
    } else {
        path = "./public/404.html".to_string();
        "HTTP/1.1 404 NOT FOUND"
    };

    let contents = if path.ends_with(".html") {
        let template_content = fs::read_to_string(&path).unwrap_or_else(|_| "Error loading file".to_string());
        let mut conn = mysql_pool.get_conn().unwrap();
        let query_result: Vec<(String, String)> = conn.query_map(
            "SELECT name, email FROM member",
            |(name, email)| {
                (name, email)
            }
        ).unwrap();

        replace_placeholders(&template_content, &query_result)
    } else {
        fs::read_to_string(&path).unwrap_or_else(|_| "Error loading file".to_string())
    };

    let response = format!("{}\r\nContent-Length: {}\r\n\r\n{}", status_line, contents.len(), contents);
    
    stream.write(response.as_bytes()).unwrap();
    stream.flush().unwrap();
}

fn replace_placeholders(template_content: &str, data: &Vec<(String, String)>) -> String {
    let mut modified_content = String::from(template_content);

    for (name, email) in data {
        modified_content = modified_content.replace("{name_placeholder}", name);
        modified_content = modified_content.replace("{email_placeholder}", email);
    }

    modified_content
}