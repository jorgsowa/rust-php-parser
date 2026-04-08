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
                      "end": 176
                    }
                  }
                },
                "span": {
                  "start": 170,
                  "end": 176
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
                "end": 182
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
                      "end": 187
                    }
                  }
                },
                "span": {
                  "start": 184,
                  "end": 187
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
                "end": 192
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
                  "end": 200
                }
              }
            },
            "span": {
              "start": 195,
              "end": 200
            }
          },
          "by_ref": false,
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * Create a new user.\n *\n * @param string $name The user's name\n * @param int $age\n * @return User\n * @throws \\InvalidArgumentException\n */",
            "span": {
              "start": 6,
              "end": 149
            }
          }
        }
      },
      "span": {
        "start": 150,
        "end": 202
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 202
  }
}
