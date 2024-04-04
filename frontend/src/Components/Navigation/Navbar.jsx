import React, { useState } from "react";
import "./Navbar.css";
import logo from './Logo/logoveia.png';


const Navbar = () => {
    const navigation = [
        { link: 'fotografias', text: 'Fotografias' },
        { link: 'videos', text: 'Vídeos' },        
        { link: 'areaPessoal', text: 'Administração' },
    ];
    const [isOpen, setOpen] = useState(false);
    const toggle = () => setOpen(!isOpen);
    const hide = () => setOpen(false);
    const show = () => setOpen(true);

    return (
        <nav>
            <div className="navbar-content">
                <a href="/home">
                    <img src={logo} alt="Logo" className={`logo ${isOpen ? 'hide' : ''}`}/> {/* Adicione a classe 'hide' quando isOpen for verdadeiro */}
                </a>
                <button className="menu-toggle" onClick={toggle}>
                    <span className={`menu ${isOpen ? 'cross' : 'hamburger'}`}></span>
                </button>
                <ul className={`menu-links ${isOpen ? 'show' : ''}`}>
                    {navigation.map((nav)=>(
                        <li key={nav.text}>
                            <a href={nav.link} onClick={toggle} onBlur={hide} onFocus={show}>{nav.text}</a>
                        </li>
                    ))}
                </ul>
            </div>
        </nav>
    );
}; 

export default Navbar;
