===source===
<?php
(void) $a ?? f();
===php_error <=8.4===
PHP Parse error:  syntax error, unexpected variable "$a" in Standard input code on line 2
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Void",
              {
                "kind": {
                  "NullCoalesce": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 13,
                        "end": 15
                      }
                    },
                    "right": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "f"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 19,
                                  "end": 20
                                }
                              }
                            },
                            "span": {
                              "start": 19,
                              "end": 20
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 22
                      }
                    }
                  }
                },
                "span": {
                  "start": 13,
                  "end": 22
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 22
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
