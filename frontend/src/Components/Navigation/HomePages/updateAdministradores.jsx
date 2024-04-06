import React, { useState, useEffect } from 'react';
import axios from 'axios';

const UpdateAdministradores = () => {
    const [users, setUsers] = useState([]);
 



    const getUsers = () => {
        axios.get('https://familia-gouveia-0f628f261ee1.herokuapp.com/components/updateAdministradores.php')
            .then(response => {
                console.log(response.data);
                if (Array.isArray(response.data)) {
                    setUsers(response.data);
                } else {
                    console.error('Data is not an array');
                }
            })
            .catch(error => {
                console.error(`There was an error retrieving the user list: ${error}`);
            });
    }

    // Obter a lista de usuários quando o componente é montado
    useEffect(() => {
        getUsers();
    }, []);

    return (
        <div>
            <h2>Adminstradores</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th> 
                        <th>Data de Criação</th>                       
                        
                    </tr>
                </thead>
                <tbody>
                    {users.map(user => (
                        <tr key={user.id_admin}>
                            <td>{user.name_admin}</td>
                            <td>{user.email_admin}</td>                         
                            <td>{user.created_at}</td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
};

export default UpdateAdministradores;
