===source===
<?php
const C = [...(null ?? 1.5)];
===errors===
Only arrays and Traversables can be unpacked, float given
===php_error <=8.3===
PHP Fatal error:  Only arrays and Traversables can be unpacked in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Only arrays and Traversables can be unpacked, float given in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "C",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "Array": [
                  {
                    "key": null,
                    "kind": {
                      "Spread": {
                        "kind": {
                          "Parenthesized": {
                            "kind": {
                              "NullCoalesce": {
                                "left": {
                                  "kind": "Null",
                                  "span": {
                                    "start": 21,
                                    "end": 25
                                  }
                                },
                                "right": {
                                  "kind": {
                                    "Float": 1.5
                                  },
                                  "span": {
                                    "start": 29,
                                    "end": 32
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 21,
                              "end": 32
                            }
                          }
                        },
                        "span": {
                          "start": 20,
                          "end": 33
                        }
                      }
                    },
                    "span": {
                      "start": 17,
                      "end": 33
                    }
                  }
                ]
              },
              "span": {
                "start": 16,
                "end": 34
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 34
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
