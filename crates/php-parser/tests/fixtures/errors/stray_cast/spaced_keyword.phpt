===source===
<?php
foo( string );
===errors===
unexpected token "(string)"
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '( string )' (string) (T_STRING_CAST) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "(string)" in Standard input code on line 2
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
                  "Name": {
                    "parts": [
                      "foo"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 9
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 9
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
                            "string"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 11,
                            "end": 17
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 17
                      }
                    }
                  },
                  "span": {
                    "start": 11,
                    "end": 17
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
