===source===
<?php
/**
 * @psalm-immutable
 */
class Money {
    /**
     * @psalm-pure
     * @param positive-int $amount
     * @return self
     */
    public static function of(int $amount): self {}

    /** @psalm-readonly */
    public int $value;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Money",
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
                  "name": "of",
                  "visibility": "Public",
                  "is_static": true,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "amount",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 168,
                              "end": 171,
                              "start_line": 11,
                              "start_col": 30
                            }
                          }
                        },
                        "span": {
                          "start": 168,
                          "end": 171,
                          "start_line": 11,
                          "start_col": 30
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
                        "start": 168,
                        "end": 179,
                        "start_line": 11,
                        "start_col": 30
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "self"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 182,
                          "end": 186,
                          "start_line": 11,
                          "start_col": 44
                        }
                      }
                    },
                    "span": {
                      "start": 182,
                      "end": 186,
                      "start_line": 11,
                      "start_col": 44
                    }
                  },
                  "body": [],
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * @psalm-pure\n     * @param positive-int $amount\n     * @return self\n     */",
                    "span": {
                      "start": 52,
                      "end": 137,
                      "start_line": 6,
                      "start_col": 4
                    }
                  }
                }
              },
              "span": {
                "start": 142,
                "end": 222,
                "start_line": 11,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "value",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 229,
                          "end": 232,
                          "start_line": 14,
                          "start_col": 11
                        }
                      }
                    },
                    "span": {
                      "start": 229,
                      "end": 232,
                      "start_line": 14,
                      "start_col": 11
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** @psalm-readonly */",
                    "span": {
                      "start": 195,
                      "end": 217,
                      "start_line": 13,
                      "start_col": 4
                    }
                  }
                }
              },
              "span": {
                "start": 222,
                "end": 239,
                "start_line": 14,
                "start_col": 4
              }
            }
          ],
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * @psalm-immutable\n */",
            "span": {
              "start": 6,
              "end": 33,
              "start_line": 2,
              "start_col": 0
            }
          }
        }
      },
      "span": {
        "start": 34,
        "end": 242,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 242,
    "start_line": 1,
    "start_col": 0
  }
}
