===config===
min_php=8.2
===source===
<?php function foo(): (self&Stringable) {}
===errors===
A parenthesized intersection type can only be used as part of a union type
Cannot use "self" when no class scope is active
===php_error===
PHP Parse error:  syntax error, unexpected token "{", expecting "|" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "foo",
            "span": {
              "start": 15,
              "end": 18
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Intersection": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "self"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 23,
                        "end": 27
                      }
                    }
                  },
                  "span": {
                    "start": 23,
                    "end": 27
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "Stringable"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 28,
                        "end": 38
                      }
                    }
                  },
                  "span": {
                    "start": 28,
                    "end": 38
                  }
                }
              ]
            },
            "span": {
              "start": 22,
              "end": 39
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 42
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42
  }
}
