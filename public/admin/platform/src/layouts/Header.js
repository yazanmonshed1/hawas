import React from 'react'
import { Navbar, Nav, NavDropdown } from 'react-bootstrap'
import { Link } from 'react-router-dom'
import { labels } from '../assets/translations/labels'

function Header() {
    return (
        <Navbar expand="lg">
            <Navbar.Collapse id="basic-navbar-nav">
                <Nav className="mr-auto">
                    <Link className="nav-link" to="/">{labels.home}</Link>
                    <NavDropdown title={labels.add_lesson} id="basic-nav-dropdown">
                        <li className="nav-item">
                            <Link className="nav-link" to="/lesson/story">{labels.story}</Link>
                        </li>
                        <li>
                            <Link className="nav-link" to="/lesson/video">{labels.video}</Link>
                        </li>
                    </NavDropdown>

                    <NavDropdown title={labels.add_exercise} id="basic-nav-dropdown">
                        <li className="nav-item">
                            <Link className="nav-link" to="/exercise/puzzle">{labels.puzzle}</Link>
                        </li>
                        <li>
                            <Link className="nav-link" to="/exercise/painting-images">{labels.painting}</Link>
                        </li>
                        <li>
                            <Link className="nav-link" to="/exercise/shape-drawings">{labels.shape_drawings}</Link>
                        </li>
                        <li>
                            <Link className="nav-link" to="/exercise/matching-words-to-sentences">{labels.matching_words_to_sentences}</Link>
                        </li>
                        <li>
                            <Link className="nav-link" to="/exercise/suitable-words">{labels.suitable_words}</Link>
                        </li>
                        <li>
                            <Link className="nav-link" to="/exercise/matching-words-with-images">{labels.matching_words_to_images}</Link>
                        </li>
                        <li>
                            <Link className="nav-link" to="/exercise/memory-game">{labels.memory_game}</Link>
                        </li>
                        <li>
                            <Link className="nav-link" to="/exercise/multiple-choices">{labels.multiple_choices}</Link>
                        </li>
                        <li>
                            <Link className="nav-link" to="/exercise/wordwall-exam">{labels.wordwall_exam}</Link>
                        </li>
                    </NavDropdown>
                </Nav>
            </Navbar.Collapse>
        </Navbar>
    )
}

export default Header
