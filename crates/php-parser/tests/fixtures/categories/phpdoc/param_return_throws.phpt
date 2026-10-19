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
          "name": {
            "name": "createUser",
            "span": {
              "start": 159,
              "end": 169
            }
          },
          "params": [
            {
              "name": {
                "name": "name",
                "span": {
                  "start": 177,
                  "end": 182
                }
              },
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
              "attributes": [],
              "span": {
                "start": 170,
                "end": 182
              }
            },
            {
              "name": {
                "name": "age",
                "span": {
                  "start": 188,
                  "end": 192
                }
              },
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
                  "end": 199
                }
              }
            },
            "span": {
              "start": 195,
              "end": 199
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
