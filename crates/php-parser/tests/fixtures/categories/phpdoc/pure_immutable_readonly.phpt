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
          "name": {
            "name": "Money",
            "span": {
              "start": 40,
              "end": 45
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
                    "name": "of",
                    "span": {
                      "start": 165,
                      "end": 167
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "amount",
                        "span": {
                          "start": 172,
                          "end": 179
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
                              "start": 168,
                              "end": 171
                            }
                          }
                        },
                        "span": {
                          "start": 168,
                          "end": 171
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 168,
                        "end": 179
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
                          "end": 186
                        }
                      }
                    },
                    "span": {
                      "start": 182,
                      "end": 186
                    }
                  },
                  "body": [],
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * @psalm-pure\n     * @param positive-int $amount\n     * @return self\n     */",
                    "span": {
                      "start": 52,
                      "end": 137
                    }
                  }
                }
              },
              "span": {
                "start": 142,
                "end": 189
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "value",
                    "span": {
                      "start": 233,
                      "end": 239
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 229,
                          "end": 232
                        }
                      }
                    },
                    "span": {
                      "start": 229,
                      "end": 232
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** @psalm-readonly */",
                    "span": {
                      "start": 195,
                      "end": 217
                    }
                  }
                }
              },
              "span": {
                "start": 222,
                "end": 239
              }
            }
          ],
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n * @psalm-immutable\n */",
            "span": {
              "start": 6,
              "end": 33
            }
          }
        }
      },
      "span": {
        "start": 34,
        "end": 242
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 242
  }
}
