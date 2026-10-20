===source===
<?php function foo(): (self&Stringable) {}
===errors 8.2-8.4===
A parenthesized intersection type can only be used as part of a union type
Type self cannot be part of an intersection type
Cannot use "self" when no class scope is active
===errors >=8.5===
A parenthesized intersection type can only be used as part of a union type
Cannot use "self" when no class scope is active
===php_error <=8.1===
PHP Parse error:  syntax error, unexpected token "(" in Standard input code on line 1
===php_error >=8.2===
PHP Parse error:  syntax error, unexpected token "{", expecting "|" in Standard input code on line 1
===ast >=8.2===
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
