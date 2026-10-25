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
          "name": {
            "name": "EventDispatcher",
            "span": {
              "start": 119,
              "end": 134
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
                    "name": "validate",
                    "span": {
                      "start": 261,
                      "end": 269
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "value",
                        "span": {
                          "start": 276,
                          "end": 282
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "mixed"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 270,
                              "end": 275
                            }
                          }
                        },
                        "span": {
                          "start": 270,
                          "end": 275
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 270,
                        "end": 282
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
                          "end": 289
                        }
                      }
                    },
                    "span": {
                      "start": 285,
                      "end": 289
                    }
                  },
                  "body": [],
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * @phpstan-assert non-empty-string $value\n     * @psalm-assert-if-true int $result\n     */",
                    "span": {
                      "start": 141,
                      "end": 240
                    }
                  }
                }
              },
              "span": {
                "start": 245,
                "end": 292
              }
            }
          ],
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * @phpstan-type Callback = callable(int): void\n * @phpstan-import-type UserId from UserRepository\n */",
            "span": {
              "start": 6,
              "end": 112
            }
          }
        }
      },
      "span": {
        "start": 113,
        "end": 294
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 294
  }
}
