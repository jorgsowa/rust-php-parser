===source===
<?php
/**
 * @psalm-type UserId = positive-int
 */
class UserRepository {
    /**
     * @psalm-param non-empty-string $name
     * @phpstan-return list<User>
     * @psalm-assert-if-true User $result
     * @psalm-suppress InvalidReturnType
     */
    public function find(string $name): array {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "UserRepository",
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
                  "name": "find",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
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
                              "start": 275,
                              "end": 281,
                              "start_line": 12,
                              "start_col": 25
                            }
                          }
                        },
                        "span": {
                          "start": 275,
                          "end": 281,
                          "start_line": 12,
                          "start_col": 25
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
                        "start": 275,
                        "end": 287,
                        "start_line": 12,
                        "start_col": 25
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "array"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 290,
                          "end": 295,
                          "start_line": 12,
                          "start_col": 40
                        }
                      }
                    },
                    "span": {
                      "start": 290,
                      "end": 295,
                      "start_line": 12,
                      "start_col": 40
                    }
                  },
                  "body": [],
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * @psalm-param non-empty-string $name\n     * @phpstan-return list<User>\n     * @psalm-assert-if-true User $result\n     * @psalm-suppress InvalidReturnType\n     */",
                    "span": {
                      "start": 78,
                      "end": 249,
                      "start_line": 6,
                      "start_col": 4
                    }
                  }
                }
              },
              "span": {
                "start": 254,
                "end": 299,
                "start_line": 12,
                "start_col": 4
              }
            }
          ],
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * @psalm-type UserId = positive-int\n */",
            "span": {
              "start": 6,
              "end": 50,
              "start_line": 2,
              "start_col": 0
            }
          }
        }
      },
      "span": {
        "start": 51,
        "end": 300,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 300,
    "start_line": 1,
    "start_col": 0
  }
}
