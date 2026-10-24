===source===
<?php
[](float);
===errors===
unexpected token "(float)"
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(float)' (double) (T_DOUBLE_CAST) in Standard input code on line 2
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected token "(double)" in Standard input code on line 2
===php_error >=8.5===
PHP Parse error:  syntax error, unexpected token "(float)" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Array": []
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "float"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 9,
                            "end": 14
                          }
                        }
                      },
                      "span": {
                        "start": 9,
                        "end": 14
                      }
                    }
                  },
                  "span": {
                    "start": 9,
                    "end": 14
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 15
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 16
  }
}
