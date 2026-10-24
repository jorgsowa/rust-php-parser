===source===
<?php
foo(void);
===errors >=8.5===
unexpected token "(void)"
===php_error >=8.5===
PHP Parse error:  syntax error, unexpected token "(void)" in Standard input code on line 2
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
                            "void"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 10,
                            "end": 14
                          }
                        }
                      },
                      "span": {
                        "start": 10,
                        "end": 14
                      }
                    }
                  },
                  "span": {
                    "start": 10,
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
