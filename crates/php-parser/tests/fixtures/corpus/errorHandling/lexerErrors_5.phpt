===source===
<?php

if ($b) {
    $a = 1;
    /* unterminated
}
===errors <=7.4===
missing closing '}'
===errors >=8.0===
unterminated block comment
missing closing '}'
===php_error <=7.4===
PHP Warning:  Unterminated comment starting line 5 in Standard input code on line 5
PHP Parse error:  syntax error, unexpected end of file in Standard input code on line 6
===php_error >=8.0===
PHP Parse error:  Unterminated comment starting line 5 in Standard input code on line 5
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 11,
              "end": 13
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "Assign": {
                          "target": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 21,
                              "end": 23
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 26,
                              "end": 27
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 21,
                        "end": 27
                      }
                    }
                  },
                  "span": {
                    "start": 21,
                    "end": 28
                  }
                }
              ]
            },
            "span": {
              "start": 15,
              "end": 28
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 7,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
