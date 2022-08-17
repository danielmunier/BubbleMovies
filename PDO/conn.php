<?php


$stmt = $conn -> prepare("INSERT INTO users (name, lastname, email, password, image, bio, token) VALUES (:name, :lastname, :email, :password, :image, :bio, :token)");