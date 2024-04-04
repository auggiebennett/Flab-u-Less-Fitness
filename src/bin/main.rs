use std::net::TcpListener;
use std::net::TcpStream;
use std::io::prelude::*;
use std::fs;
use mtr_server_app::ThreadPool;

fn main() {
    let listener = TcpListener::bind("127.0.0.1:7878").unwrap();
    let pool = ThreadPool::new(4);

    for stream in listener.incoming() {
        let stream = stream.unwrap();

        pool.execute(|| {
            handle_connection(stream);
        });
    }
}

fn handle_connection(mut stream: TcpStream) {
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

    let contents = fs::read_to_string(&path).unwrap_or_else(|_| "Error loading file".to_string());

    let response = format!("{}\r\nContent-Length: {}\r\n\r\n{}", status_line, contents.len(), contents);
    
    stream.write(response.as_bytes()).unwrap();
    stream.flush().unwrap();
}
