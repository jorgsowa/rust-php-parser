===source===
<?php
const D = Foo::b();
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
              "name": "D",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "StaticMethodCall": {
                  "class": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "Foo"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 16,
                          "end": 19
                        }
                      }
                    },
                    "span": {
                      "start": 16,
                      "end": 19
                    }
                  },
                  "method": {
                    "kind": {
                      "Identifier": "b"
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
                "start": 16,
                "end": 24
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 24
            }
          }
        ]
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
