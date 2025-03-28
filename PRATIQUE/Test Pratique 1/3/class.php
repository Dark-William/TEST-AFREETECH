<?php
class User {
    private $users = [];

    public function create($name, $email) {
        $this->users[] = ['id' => count($this->users) + 1, 'name' => $name, 'email' => $email];
        echo "Utilisateur ajouté : $name ($email) \n";
    }

    public function read() {
        foreach ($this->users as $user) {
            echo "ID : {$user['id']} - Nom : {$user['name']} - Email : {$user['email']}\n";
        }
    }

    public function update($id, $newName, $newEmail) {
        foreach ($this->users as &$user) {
            if ($user['id'] == $id) {
                $user['name'] = $newName;
                $user['email'] = $newEmail;
                echo "Utilisateur mis à jour : $newName ($newEmail) \n";
                return;
            }
        }
        echo "Utilisateur introuvable !<br>";
    }

    public function delete($id) {
        foreach ($this->users as $key => $user) {
            if ($user['id'] == $id) {
                unset($this->users[$key]);
                echo "Utilisateur supprimé (ID : $id) \n";
                return;
            }
        }
        echo "Utilisateur non trouvé !<br>";
    }
}


$userManager = new User();
$userManager->create('William Stone', 'william@example.com');
$userManager->create('Jane Foster', 'jane@example.com');

echo "\n<h3>Liste des utilisateurs :</h3>\n";
$userManager->read();

$userManager->update(1, 'NDI ETOUNDI', 'ndi.etoundi@example.com');
$userManager->delete(2);

echo "<h3>Après modification :</h3>";
$userManager->read();
