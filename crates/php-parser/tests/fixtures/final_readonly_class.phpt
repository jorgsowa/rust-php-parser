===config===
min_php=8.2
===source===
<?php
final readonly class Money {
    public function __construct(
        public int $amount,
        public string $currency,
    ) {}
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
              "start": 27,
              "end": 32
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": true,
            "is_readonly": true
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 55,
                      "end": 66
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "amount",
                        "span": {
                          "start": 87,
                          "end": 94
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
                              "start": 83,
                              "end": 86
                            }
                          }
                        },
                        "span": {
                          "start": 83,
                          "end": 86
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 76,
                        "end": 94
                      }
                    },
                    {
                      "name": {
                        "name": "currency",
                        "span": {
                          "start": 118,
                          "end": 127
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
                              "start": 111,
                              "end": 117
                            }
                          }
                        },
                        "span": {
                          "start": 111,
                          "end": 117
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 104,
                        "end": 127
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 39,
                "end": 137
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 21,
        "end": 139
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 139
  }
}
