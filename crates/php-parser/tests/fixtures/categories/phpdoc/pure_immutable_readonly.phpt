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
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
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
                  "attributes": []
                }
              },
              "span": {
                "start": 142,
                "end": 222
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
                  "attributes": []
                }
              },
              "span": {
                "start": 222,
                "end": 239
              }
            }
          ],
          "attributes": []
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
