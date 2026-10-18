===source===
<?php

foo(Bar::);
===errors===
expected identifier, found ')'
===php_error===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 3
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
                      "start": 7,
                      "end": 10
                    }
                  }
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
                    "kind": "Error",
                    "span": {
                      "start": 11,
                      "end": 17
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 11,
                    "end": 17
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
