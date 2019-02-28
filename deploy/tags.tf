resource "digitalocean_tag" "nginx"          { name = "nginx" }
resource "digitalocean_tag" "docker-compose" { name = "docker-compose" }
resource "digitalocean_tag" "wordpress"      { name = "wordpress" }
resource "digitalocean_tag" "php"            { name = "php" }