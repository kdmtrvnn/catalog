import React, { useState, useEffect } from "react";
import ReactDOM from "react-dom";
import { object, string } from "yup";
import { Formik, Form, Field } from "formik";
import Chip from "@mui/material/Chip";
import Autocomplete from "@mui/material/Autocomplete";
import TextField from "@mui/material/TextField";
import Stack from "@mui/material/Stack";
import axios from "axios";

export default function Create() {
  const [book, setBook] = useState("");
  const [year, setYear] = useState("");
  const [authors, setAuthors] = useState("");

  useEffect(async () => {
    let authors = [];
    window.authors.map((p) => authors.push({ name: p.name }));
    await setAuthors(authors);
  }, []);

  const create = async (values) => {
    let arr = [];
    arr.push({ name: values.book, year: values.year, authors: authors });

    try {
      await axios.post("/admin/books/create", arr);
    } catch (e) {
      alert("Произошла ошибка. Попробуйте обновить страницу.");

      return;
    }

    window.location.href = '/admin/books/get';
  };

  return (
    <Formik
      onSubmit={create}
      initialValues={{
        book: book,
        year: year,
      }}
    >
      {({ isSubmitting, values, errors, touched, setFieldValue }) => (
        <Form>
          <div className="container py-4">
            <div className="row">
              <div className="col-lg-4 offset-lg-4">
                <div className="form-group">
                  <label>Название книги</label>
                  <Field
                    className="form-control mb-3"
                    type="text"
                    name="book"
                    id="book"
                    required
                  />
                  <label>Год</label>
                  <Field
                    className="form-control mb-4"
                    type="number"
                    name="year"
                    id="year"
                    required
                  />
                  <Stack spacing={3} sx={{ width: 300 }}>
                    <Autocomplete
                      onChange={(event, value) => setAuthors(value)}
                      multiple
                      className="mb-4"
                      id="tags-outlined"
                      size="small"
                      options={window.authors.map((p) => p.name)}
                      getOptionLabel={(authors) => authors}
                      filterSelectedOptions
                      renderInput={(params) => (
                        <TextField {...params} label="Авторы" />
                      )}
                    />
                  </Stack>
                  <button type="submit" className="btn btn-secondary">
                    Добавить книгу
                  </button>
                </div>
              </div>
            </div>
          </div>
        </Form>
      )}
    </Formik>
  );
}

const elem = document.querySelector("#create");

if (elem) {
  ReactDOM.render(<Create />, elem);
}