//form script start here
let standard = document.getElementById('class1')
let options = document.querySelectorAll('.select-box option')

standard.addEventListener('change', () => {
    let v = standard.value.toUpperCase()
    if (v == 'OTHER') {
        standard.parentElement.classList.replace('col-12', 'col-6')
        standard.parentElement.nextElementSibling.classList.remove('d-none')
        standard.parentElement.nextElementSibling.children[1].focus()
    } else {
        standard.parentElement.classList.replace('col-6', 'col-12')
        standard.parentElement.nextElementSibling.classList.add('d-none')
    }
})

let form = document.getElementById('myForm')

let n = document.getElementById('newEntry')
let submit = document.getElementById('submit-btn')

let formElement = document.querySelectorAll('.form-control')
n.addEventListener('click', e => {
    e.preventDefault()
    for (i = 1; i < formElement.length; i++) {
        formElement[i].removeAttribute('readonly')
        if (formElement[i].hasAttribute('disabled'))
            formElement[i].removeAttribute('disabled')
    }

    fetch('/getLast', {
        method: 'GET',
        header: {},
        body: null
    })
        .then(res => res.json())
        .then(d => {
            formElement[0].value = d.data
        })
    formElement[1].focus()
    edit.setAttribute('disabled', true)
    delete1.setAttribute('disabled', true)

    submit.removeAttribute('disabled')

    form.setAttribute('action', 'http://localhost:8000/insert/student')

    n.setAttribute('disabled', true)
})

let cancel = document.getElementById('cancel-btn')
let edit = document.getElementById('edit-btn')
let delete1 = document.getElementById('delete-btn')
let small = document.querySelectorAll('.error')
let idError = document.getElementsByClassName('error-id')[0]
let method = document.getElementById('method')
let table = document.getElementById('table-container')

cancel.addEventListener('click', e => {
    e.preventDefault()
    form.reset()
    for (i = 0; i < formElement.length; i++) {
        formElement[i].value = ''
    }

    standard.parentElement.classList.replace('col-6', 'col-12')
    standard.parentElement.nextElementSibling.classList.add('d-none')

    small.forEach(e => {
        e.innerHTML = ''
    })

    idError.innerHTML = ''

    console.log('reset')

    for (i = 0; i < formElement.length; i++) {
        formElement[i].setAttribute('readonly', true)
    }

    formElement[3].setAttribute('disabled', true)

    edit.removeAttribute('disabled')
    delete1.removeAttribute('disabled')
    n.removeAttribute('disabled')

    submit.setAttribute('disabled', true)
})

edit.addEventListener('click', e => {
    e.preventDefault()
    n.setAttribute('disabled', true)
    delete1.setAttribute('disabled', true)

    for (i = 0; i < formElement.length; i++) {
        formElement[i].removeAttribute('readonly')
        if (formElement[i].hasAttribute('disabled'))
            formElement[i].removeAttribute('disabled')
    }

    let input = document.createElement('input')
    input.setAttribute('type', 'hidden')
    input.setAttribute('name', '_method')
    input.setAttribute('value', 'PUT')
    method.append(input)

    formElement[0].focus()

    form.setAttribute('action', 'http://localhost:8000/update/student')
    edit.setAttribute('disabled', true)
})
let newAction
formElement[0].addEventListener('keyup', e => {
    if (e.key == 'Enter') {
        let v = formElement[0].value
        let flag = 0
        console.log('data')
        let p = {
            method: 'GET',
            header: {},
            body: null
        }

        fetch(`/getSingle/${v}`, p)
            .then(res => res.json())
            .then(d => {
                if ('error' in d[0]) {
                    idError.innerHTML = d[0].error
                    setTimeout(() => {
                        idError.innerHTML = ''
                    }, 3000)
                } else {
                    formElement[1].value = d[0].std_name
                    formElement[2].value = d[0].email
                    options.forEach(e => {
                        if (e.value != d[0].std_class) {
                            flag = 1
                            console.log(e.value)
                            // options[7].setAttribute('selected', true)
                            formElement[3].value = 'other'
                            standard.parentElement.classList.replace(
                                'col-12',
                                'col-6'
                            )
                            standard.parentElement.nextElementSibling.classList.remove(
                                'd-none'
                            )
                            standard.parentElement.nextElementSibling.children[1].focus()
                            standard.parentElement.nextElementSibling.children[1].value =
                                d[0].std_class
                        }
                    })
                    if (flag == 0) {
                        options.forEach(e => {
                            if (e.value === d[0].std_class) {
                                e.setAttribute('selected', true)
                            }
                        })
                    }

                    formElement[5].value = d[0].age
                    formElement[0].setAttribute('disabled', true)
                    newAction = form.attributes.item(3).value.concat(`/${v}`)
                    form.setAttribute('action', newAction)
                    submit.removeAttribute('disabled')
                }
            })
    }

    if (e.ctrlKey == true && e.key == 'q') {
        if (!formElement[0].hasAttribute('readonly')) {
            table.classList.remove('d-none')
            formElement[6].removeAttribute('readonly')
        } else alert('The input field are disabled!!')
    }
})

delete1.addEventListener('click', e => {
    e.preventDefault()
    n.setAttribute('disabled', true)
    if (formElement[0].hasAttribute('disabled'))
        formElement[0].removeAttribute('disabled')

    edit.setAttribute('disabled', true)
    formElement[3].setAttribute('disabled', true)
    formElement[0].removeAttribute('readonly')

    let input = document.createElement('input')
    input.setAttribute('type', 'hidden')
    input.setAttribute('name', '_method')
    input.setAttribute('value', 'GET')

    method.append(input)

    form.setAttribute('action', 'http://localhost:8000/delete/student')

    formElement[0].focus()
    delete1.setAttribute('disabled', true)
})

//table script start here
let closeImg = document.getElementById('close-img')
let selectBtn = document.getElementById('select-button')
let tableRow = document.querySelectorAll('#tableData tr')

closeImg.addEventListener('click', () => {
    table.classList.add('d-none')
    tableRow.forEach(e => {
        if (
            e.classList.contains('bg-primary') &&
            e.classList.contains('text-light')
        ) {
            e.classList.remove('bg-primary')
            e.classList.remove('text-light')
        }
    })

    if (!selectBtn.hasAttribute('disabled'))
        selectBtn.setAttribute('disabled', true)
})

let search = document.getElementById('search')
search.addEventListener('input', () => {
    let searchValue = search.value.toUpperCase()
    let searchKey = document.querySelectorAll('#tableData tr .searchKey')
    searchKey.forEach(e => {
        let stdName = e.textContent.toUpperCase()
        if (stdName.indexOf(searchValue) > -1) {
            e.parentElement.style.display = ''
        } else {
            e.parentElement.style.display = 'none'
        }
    })
})

tableRow.forEach(e => {
    e.addEventListener('click', () => {
        tableRow.forEach(hide => {
            e.classList.add('text-light', 'bg-primary')
            hide.classList.remove('text-light', 'bg-primary')
            e.setAttribute('id', 'selectedRow')
            if (hide.hasAttribute('id')) hide.removeAttribute('id')
            selectBtn.removeAttribute('disabled')
        })
    })
})

selectBtn.addEventListener('click', () => {
    let selectedRow = document.getElementById('selectedRow')
    formElement[0].value = selectedRow.children[0].textContent
    formElement[1].value = selectedRow.children[1].textContent
    formElement[2].value = selectedRow.children[2].textContent
    formElement[5].value = selectedRow.children[4].textContent

    options.forEach(e => {
        let opValue = e.value.toUpperCase()
        let selectedClassValue = selectedRow.children[3].textContent

        if (opValue != selectedClassValue) {
            options[6].setAttribute('selected', true)
            formElement[4].value = selectedClassValue
            standard.parentElement.classList.replace('col-12', 'col-6')
            standard.parentElement.nextElementSibling.classList.remove('d-none')
        } else {
            e.setAttribute('selected', true)
        }
    })

    formElement[0].setAttribute('disabled', true)
    let v = selectedRow.children[0].textContent
    newAction = form.attributes.item(3).value.concat(`/${v}`)

    form.setAttribute('action', newAction)
    submit.removeAttribute('disabled')

    closeImg.click()
})
