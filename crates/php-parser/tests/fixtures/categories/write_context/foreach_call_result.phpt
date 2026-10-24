===source===
<?php foreach ($a as f()) {}
===errors===
Can't use function return value in write context
===php_error===
PHP Fatal error:  Can't use function return value in write context in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 15,
              "end": 17
            }
          },
          "key": null,
          "value": {
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
                        "start": 21,
                        "end": 22
                      }
                    }
                  },
                  "span": {
                    "start": 21,
                    "end": 22
                  }
                },
                "args": []
              }
            },
            "span": {
              "start": 21,
              "end": 24
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 26,
              "end": 28
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
