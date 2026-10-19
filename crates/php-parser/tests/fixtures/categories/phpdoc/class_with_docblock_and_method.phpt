===source===
<?php

/**
 * User class for managing users
 * @see UserRepository
 * @deprecated Use UserService instead
 */
class User {
    /**
     * Get user by ID
     */
    public function getById($id) {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "User",
            "span": {
              "start": 116,
              "end": 120
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "getById",
                    "span": {
                      "start": 181,
                      "end": 188
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "id",
                        "span": {
                          "start": 189,
                          "end": 192
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 189,
                        "end": 192
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * Get user by ID\n     */",
                    "span": {
                      "start": 127,
                      "end": 160
                    }
                  }
                }
              },
              "span": {
                "start": 165,
                "end": 196
              }
            }
          ],
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * User class for managing users\n * @see UserRepository\n * @deprecated Use UserService instead\n */",
            "span": {
              "start": 7,
              "end": 109
            }
          }
        }
      },
      "span": {
        "start": 110,
        "end": 198
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 198
  }
}
