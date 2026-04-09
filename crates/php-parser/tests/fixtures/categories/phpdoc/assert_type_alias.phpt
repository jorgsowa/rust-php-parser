===source===
<?php
/**
 * @phpstan-type Callback = callable(int): void
 * @phpstan-import-type UserId from UserRepository
 */
class EventDispatcher {
    /**
     * @phpstan-assert non-empty-string $value
     * @psalm-assert-if-true int $result
     */
    public function validate(mixed $value): bool {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "EventDispatcher",
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
                  "name": "validate",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "value",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "mixed"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 270,
                              "end": 275,
                              "start_line": 11,
                              "start_col": 29
                            }
                          }
                        },
                        "span": {
                          "start": 270,
                          "end": 275,
                          "start_line": 11,
                          "start_col": 29
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
                        "start": 270,
                        "end": 282,
                        "start_line": 11,
                        "start_col": 29
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "bool"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 285,
                          "end": 289,
                          "start_line": 11,
                          "start_col": 44
                        }
                      }
                    },
                    "span": {
                      "start": 285,
                      "end": 289,
                      "start_line": 11,
                      "start_col": 44
                    }
                  },
                  "body": [],
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * @phpstan-assert non-empty-string $value\n     * @psalm-assert-if-true int $result\n     */",
                    "span": {
                      "start": 141,
                      "end": 240,
                      "start_line": 7,
                      "start_col": 4
                    }
                  }
                }
              },
              "span": {
                "start": 245,
                "end": 293,
                "start_line": 11,
                "start_col": 4
              }
            }
          ],
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * @phpstan-type Callback = callable(int): void\n * @phpstan-import-type UserId from UserRepository\n */",
            "span": {
              "start": 6,
              "end": 112,
              "start_line": 2,
              "start_col": 0
            }
          }
        }
      },
      "span": {
        "start": 113,
        "end": 294,
        "start_line": 6,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 294,
    "start_line": 1,
    "start_col": 0
  }
}
