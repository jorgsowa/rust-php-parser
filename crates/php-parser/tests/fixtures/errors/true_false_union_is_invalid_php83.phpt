===config===
min_php=8.2
max_php=8.3
===source===
<?php function f(): true|false {}
===errors===
Type contains both true and false, bool must be used instead
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "f",
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "true"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 20,
                        "end": 24
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 24
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "false"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 25,
                        "end": 30
                      }
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 30
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 30
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
===php_error===
PHP Fatal error:  Type contains both true and false, bool should be used instead in Standard input code on line 1
