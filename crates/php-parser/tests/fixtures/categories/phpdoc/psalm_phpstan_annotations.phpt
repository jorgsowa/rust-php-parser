===source===
<?php
/**
 * @psalm-type UserId = positive-int
 */
class UserRepository {
    /**
     * @psalm-param non-empty-string $name
     * @phpstan-return list<User>
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
                              "start": 233,
                              "end": 239
                            }
                          }
                        },
                        "span": {
                          "start": 233,
                          "end": 239
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
                        "start": 233,
                        "end": 245
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
                          "start": 248,
                          "end": 253
                        }
                      }
                    },
                    "span": {
                      "start": 248,
                      "end": 253
                    }
                  },
                  "body": [],
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * @psalm-param non-empty-string $name\n     * @phpstan-return list<User>\n     * @psalm-suppress InvalidReturnType\n     */",
                    "span": {
                      "start": 78,
                      "end": 207
                    }
                  }
                }
              },
              "span": {
                "start": 212,
                "end": 256
              }
            }
          ],
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * @psalm-type UserId = positive-int\n */",
            "span": {
              "start": 6,
              "end": 50
            }
          }
        }
      },
      "span": {
        "start": 51,
        "end": 258
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 258
  }
}
