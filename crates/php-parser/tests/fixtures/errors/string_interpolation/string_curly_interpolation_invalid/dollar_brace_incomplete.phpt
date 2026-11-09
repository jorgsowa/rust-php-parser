===source===
<?php
echo "${a + }";
===errors===
expected expression, found '}'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '}' in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "}" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Expr": {
                    "kind": {
                      "VariableVariable": {
                        "kind": {
                          "Binary": {
                            "left": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "a"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 14,
                                    "end": 15
                                  }
                                }
                              },
                              "span": {
                                "start": 14,
                                "end": 15
                              }
                            },
                            "op": "Add",
                            "right": {
                              "kind": "Error",
                              "span": {
                                "start": 17,
                                "end": 17
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 14,
                          "end": 17
                        }
                      }
                    },
                    "span": {
                      "start": 12,
                      "end": 19
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 11,
              "end": 20
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
