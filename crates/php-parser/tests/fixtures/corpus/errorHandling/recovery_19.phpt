===source===
<?php

foo(Bar::);
===errors===
expected identifier, found ')'
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
                  "Identifier": "foo"
                },
                "span": {
                  "start": 7,
                  "end": 10
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "ClassConstAccess": {
                        "class": {
                          "kind": {
                            "Identifier": "Bar"
                          },
                          "span": {
                            "start": 11,
                            "end": 14
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "<error>"
                          },
                          "span": {
                            "start": 16,
                            "end": 17
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 11,
                      "end": 16
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 11,
                    "end": 16
                  }
                }
              ]
            }
          },
          "span": {
            "start": 7,
            "end": 17
          }
        }
      },
      "span": {
        "start": 7,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 3
