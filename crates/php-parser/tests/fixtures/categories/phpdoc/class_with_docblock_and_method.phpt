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
          "name": "User",
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
                  "name": "getById",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "id",
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
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
