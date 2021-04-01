import React, { useEffect, useState } from 'react'

import { Toast } from "react-bootstrap";
import { useDispatch, useSelector } from 'react-redux';
import { showToastr } from '../actions';
import { labels } from '../assets/translations/labels';

export default function Toaster() {

    const errors = useSelector(state => state.errors)
    const show = useSelector(state => state.showToastr)

    const dispatch = useDispatch()

    const renderError = (key, error) => <li key={key} className="text-danger">
        {error}
    </li>

    return (
        <Toast className="redux-bootstrap-toastr" onClose={() => dispatch(showToastr(false))} show={show} delay={6000} autohide>
            <Toast.Header className="bg-danger">
                <strong className="mr-auto text-white">{labels.error}</strong>
            </Toast.Header>
            <Toast.Body className="bg-white">
                {errors && <ul>
                    {Object.keys(errors).map(key => renderError(key, errors[key]))}
                </ul>}
            </Toast.Body>
        </Toast>
    );
}