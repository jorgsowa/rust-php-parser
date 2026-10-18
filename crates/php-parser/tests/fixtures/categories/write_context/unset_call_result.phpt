===source===
<?php unset(f());
===errors===
Can't use this expression in write context
===php_error===
PHP Fatal error:  Can't use function return value in write context in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Unset": [
          {
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
                        "start": 12,
                        "end": 13
                      }
                    }
                  },
                  "span": {
                    "start": 12,
                    "end": 13
                  }
                },
                "args": []
              }
            },
            "span": {
              "start": 12,
              "end": 15
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 17
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17
  }
}
