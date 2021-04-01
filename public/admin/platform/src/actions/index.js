export const setBook = (book) => {
    return {
        type: 'SET_BOOK',
        payload: book,
    };
};

export const setChapters = (chapters) => {
    return {
        type: 'SET_CHAPTERS',
        payload: chapters,
    };
};

export const addChapter = (chapter) => {
    return {
        type: 'ADD_CHAPTER',
        payload: chapter,
    };
};

export const setErrors = (errors) => {
    return {
        type: 'SET_ERRORS',
        payload: errors,
    };
};

export const showToastr = (show) => {
    return {
        type: 'SHOW_TOASTR',
        payload: show,
    };
};