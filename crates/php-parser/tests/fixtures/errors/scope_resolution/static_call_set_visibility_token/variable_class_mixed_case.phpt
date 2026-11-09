===source===
<?php
$c::PROTECTED(Set);
===errors >=8.4===
unexpected token "protected(set)"
===php_error >=8.4===
PHP Parse error:  syntax error, unexpected token "protected(set)" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "method": {
                "kind": {
                  "Identifier": "PROTECTED"
                },
                "span": {
                  "start": 10,
                  "end": 19
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
                            "Set"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 20,
                            "end": 23
                          }
                        }
                      },
                      "span": {
                        "start": 20,
                        "end": 23
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 23
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
