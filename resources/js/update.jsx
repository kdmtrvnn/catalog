import React, { useState, useEffect } from "react";
import ReactDOM from "react-dom";
import { object, string } from "yup";
import { Formik, Form, Field } from "formik";
import Chip from "@mui/material/Chip";
import Autocomplete from "@mui/material/Autocomplete";
import TextField from "@mui/material/TextField";
import Stack from "@mui/material/Stack";
import axios from "axios";

export default function Update() {
  const [book, setBook] = useState("");
  const [year, setYear] = useState("");
  const [authors, setAuthors] = useState("");

  useEffect(async () => {
    let authors = [];
    window.authors.map((p) => authors.push({ name: p.name }));
    await setAuthors(authors);
  }, []);

  const update = async (values) => {
    let arr = [];
    arr.push({ id: window.id, name: values.book, year: values.year, authors: authors });

    try {
      await axios.post("/admin/books/update", arr);
    } catch (e) {
      alert("Произошла ошибка. Попробуйте обновить страницу.");

      return;
    }
  };

  return (
    <Formik
      onSubmit={update}
      initialValues={{
        book: window.book.name,
        year: window.book.year,
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
                      defaultValue={window.authorsBook.map((p) => p.name)}
                      filterSelectedOptions
                      renderInput={(params) => (
                        <TextField {...params} label="Авторы" />
                      )}
                    />
                  </Stack>
                  <button type="submit" className="btn btn-secondary">
                    Редактировать
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

const elem = document.querySelector("#update");

if (elem) {
  ReactDOM.render(<Update />, elem);
}
