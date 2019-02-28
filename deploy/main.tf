provider "digitalocean" {
    token = "${var.token}"
}

resource "digitalocean_droplet" "my-mad-blog-web" {
    name = "my-mad-blog-web"
    image = "44117234"
    size = "512mb"
    region = "sgp1"
    ipv6 = true
    private_networking = false
    tags = [
        "${digitalocean_tag.wordpress.name}",
        "${digitalocean_tag.nginx.name}",
        "${digitalocean_tag.php.name}",
        "${digitalocean_tag.docker-compose.name}",
    ]
    ssh_keys = ["f5:cf:ab:81:39:28:bb:a7:b2:03:b3:c2:b5:d2:84:84"]
}
