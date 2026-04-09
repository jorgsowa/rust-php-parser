===source===
<?php
/**
 * Create a new user.
 *
 * @param string $name The user's name
 * @param int $age
 * @return User
 * @throws \InvalidArgumentException
 */
function createUser(string $name, int $age): User {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "createUser",
          "params": [
            {
              "name": "name",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "string"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 170,
                      "end": 176,
                      "start_line": 10,
                      "start_col": 20
                    }
                  }
                },
                "span": {
                  "start": 170,
                  "end": 176,
                  "start_line": 10,
                  "start_col": 20
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 170,
                "end": 182,
                "start_line": 10,
                "start_col": 20
              }
            },
            {
              "name": "age",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "int"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 184,
                      "end": 187,
                      "start_line": 10,
                      "start_col": 34
                    }
                  }
                },
                "span": {
                  "start": 184,
                  "end": 187,
                  "start_line": 10,
                  "start_col": 34
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 184,
                "end": 192,
                "start_line": 10,
                "start_col": 34
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "User"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 195,
                  "end": 200,
                  "start_line": 10,
                  "start_col": 45
                }
              }
            },
            "span": {
              "start": 195,
              "end": 200,
              "start_line": 10,
              "start_col": 45
            }
          },
          "by_ref": false,
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * Create a new user.\n *\n * @param string $name The user's name\n * @param int $age\n * @return User\n * @throws \\InvalidArgumentException\n */",
            "span": {
              "start": 6,
              "end": 149,
              "start_line": 2,
              "start_col": 0
            }
          }
        }
      },
      "span": {
        "start": 150,
        "end": 202,
        "start_line": 10,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 202,
    "start_line": 1,
    "start_col": 0
  }
}
