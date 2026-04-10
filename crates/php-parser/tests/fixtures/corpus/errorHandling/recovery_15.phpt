===source===
<?php
Foo::$
===errors===
expected expression
expected ';' after expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccessDynamic": {
              "class": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "member": {
                "kind": {
                  "VariableVariable": {
                    "kind": "Error",
                    "span": {
                      "start": 12,
                      "end": 12
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 12
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 12
          }
        }
      },
      "span": {
        "start": 6,
        "end": 12
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 12
  }
}
