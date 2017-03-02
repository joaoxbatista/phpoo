<?php


class Usuario{
	
	/**
	* Atributos
	*/
	protected $nome;
	protected $email;
	protected $senha;

	public function __construct($nome, $email, $senha){
		$this->nome = $nome;
		$this->senha = md5($senha);
		$this->email = $email;
	}
	
    public function getArray(){
        return [
            "nome" => $this->nome,
            "email" => $this->email,
            "senha" => $this->senha
        ];
    }
    /**
     * Gets the value of nome.
     *
     * @return mixed
     */
    public function getNome()
    {
    	return $this->nome;
    }

    /**
     * Gets the value of email.
     *
     * @return mixed
     */
    public function getEmail()
    {
    	return $this->email;
    }

    /**
     * Gets the value of senha.
     *
     * @return mixed
     */
    public function getSenha()
    {
    	return $this->senha;
    }


    /**
     * Sets the value of nome.
     *
     * @param mixed $nome the nome
     *
     * @return self
     */
    protected function setNome($nome)
    {
    	$this->nome = $nome;

    	return $this;
    }

    /**
     * Sets the value of email.
     *
     * @param mixed $email the email
     *
     * @return self
     */
    protected function setEmail($email)
    {
    	$this->email = $email;

    	return $this;
    }

    /**
     * Sets the value of senha.
     *
     * @param mixed $senha the senha
     *
     * @return self
     */
    protected function setSenha($senha)
    {
    	$this->senha = $senha;

    	return $this;
    }
}