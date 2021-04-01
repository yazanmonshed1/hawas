import React from 'react'
import { useSelector } from 'react-redux'
import Toaster from '../components/Toaster'
import Header from './Header'

function Layout({ children, title = null, main = false }) {

    const bookTitle = useSelector(state => state.book.title)
    return (
        <>
            <h1 className="mb-3">{bookTitle}</h1>
            <div className="seperator"></div>
            <Toaster />
            {title && <h4 className="mb-3">{title}</h4>}
            {/* {!main && <Header />} */}
            {children}
        </>
    )
}

export default Layout
