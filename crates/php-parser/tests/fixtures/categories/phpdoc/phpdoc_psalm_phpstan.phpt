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
          "name": {
            "name": "UserRepository",
            "span": {
              "start": 57,
              "end": 71
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
                    "name": "find",
                    "span": {
                      "start": 270,
                      "end": 274
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "name",
                        "span": {
                          "start": 282,
                          "end": 287
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
                              "start": 275,
                              "end": 281
                            }
                          }
                        },
                        "span": {
                          "start": 275,
                          "end": 281
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 275,
                        "end": 287
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
                          "end": 295
                        }
                      }
                    },
                    "span": {
                      "start": 290,
                      "end": 295
                    }
                  },
                  "body": [],
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * @psalm-param non-empty-string $name\n     * @phpstan-return list<User>\n     * @psalm-assert-if-true User $result\n     * @psalm-suppress InvalidReturnType\n     */",
                    "span": {
                      "start": 78,
                      "end": 249
                    }
                  }
                }
              },
              "span": {
                "start": 254,
                "end": 298
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
        "end": 300
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 300
  }
}
