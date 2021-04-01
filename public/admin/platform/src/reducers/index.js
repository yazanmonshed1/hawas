const config = {
    book: null,
    chapters: null,
    errors: null,
    showToastr: false
};

const AppReducer = (state = config, { type, payload }) => {
    switch (type) {
        case 'SET_BOOK':
            return { ...state, book: payload };
        case 'SET_CHAPTERS':
            return { ...state, chapters: payload };
        case 'ADD_CHAPTER':
            return {
                ...state,
                chapters: [...state.chapters, payload]
            }
        case 'SET_ERRORS':
            return { ...state, errors: payload };
        case 'SHOW_TOASTR':
            return { ...state, showToastr: payload };
        default:
            return state;
    }
};

export default AppReducer;