===source===
<?php
const K = `ls`;
===errors===
Constant expression contains invalid operations
===php_error===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "K",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "ShellExec": [
                  {
                    "Literal": "ls"
                  }
                ]
              },
              "span": {
                "start": 16,
                "end": 20
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
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
