<?php

class UsuarioModel extends Model {
    /*
     * Retorna o nº de dias que foi trocada a senha
     */

    public function lastChangePassword($id) {
        $sql = "SELECT TIMESTAMPDIFF(DAY, dtupdate, now()) as senha_dias from usuario where id_user = :id";
        $resultado = $this->ExecuteQuery($sql, [':id' => $id]);
        if ($resultado) {
            $user = $resultado[0];
            return $user['senha_dias'];
        } else {
            return 0;
        }
    }

    public function getUsuarioByLogin($login) {
        $sql = "SELECT * FROM usuario WHERE login=:login";
        $resultado = $this->ExecuteQuery($sql, [':login' => $login]);
        echo $login;
        if ($resultado) {
            echo "entrou";
            $user = $resultado[0];
            return new Usuario($user['login'], $user['senha'], $user['nome'], $user['email'], $user['id_user']);
        } else {
            return $resultado;
        }
    }

    public function getUsuarioByEmail($email) {
        $sql = "SELECT * FROM usuario WHERE email = :email";
        $resultado = $this->ExecuteQuery($sql, [':email' => $email]);
        if ($resultado) {
            $user = $resultado[0];
            return new Usuario($user['login'], $user['senha'], $user['nome'], $user['email'], $user['id_user']);
        } else {
            return false;
        }
    }

    public function getUsuarios() {
        $list = array();
        $sql = "SELECT * FROM usuario";

        $resultados = $this->ExecuteQuery($sql, array());

        foreach ($resultados as $linha) {
            $list[] = new Usuario(
                    $linha['login'], $linha['senha'], $linha['nome'], $linha['email'], $linha['id_user']);
        }
        return $list;
    }

    public function getUsuarioById($id) {
        $sql = "SELECT * FROM usuario as ne WHERE ne.id_user = :id_user;";
        $linha = $this->ExecuteQuery($sql, [':id_user' => $id])[0];
        return new Usuario(
                $linha['login'], $linha['senha'], $linha['nome'], $linha['email'], $linha['id_user']);
    }

    public function insert($obj) {
        $sql = "INSERT INTO usuario(nome,login,senha , email) VALUES(:nome,:login, :senha, :email)";
        return $this->ExecuteCommand($sql, [':nome' => $obj->getNome(),
                    ':login' => $obj->getLogin(),
                    ':senha' => md5($obj->getSenha()),
                    ':email' => $obj->getEmail()
        ]);
    }

    public function remove($id) {
        $sql = "DELETE FROM usuario WHERE id_user = :id";
        return $this->ExecuteCommand($sql, [':id' => $id]);
    }

    public function update($obj) {
        $sql = "UPDATE usuario SET nome = :nome, login = :login, senha = :senha, email = :email  WHERE id_user = :id";
        $param = [':nome' => $obj->getNome(),
            ':login' => $obj->getLogin(),
            ':senha' => md5($obj->getSenha()),
            ':email' => $obj->getEmail(),
            ':id' => $obj->getId_user()
        ];
        if ($this->ExecuteCommand($sql, $param)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateSenha($obj) {
        $sql = "UPDATE usuario SET  senha = :senha, dtupdate = now()  WHERE id_user = :id";
        $param = [
            ':senha' => md5($obj->getSenha()),
            ':id' => $obj->getId_user()
        ];
        if ($this->ExecuteCommand($sql, $param)) {
            return true;
        } else {
            return false;
        }
    }

    public function gerarSenha($obj) {
        $sql = "UPDATE usuario SET  senha = :senha, dtupdate = '1900-12-01 00:00:00' "
                . " WHERE id_user = :id";
        $param = [
            ':senha' => md5($obj->getSenha()),
            ':id' => $obj->getId_user()
        ];
        if ($this->ExecuteCommand($sql, $param)) {
            return true;
        } else {
            return false;
        }
    }

}
