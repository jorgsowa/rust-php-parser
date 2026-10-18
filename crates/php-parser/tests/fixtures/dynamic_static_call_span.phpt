===source===
<?php Foo::{$m}();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCallDynamic": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "Foo"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 9
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "method": {
                "kind": {
                  "Variable": "m"
                },
                "span": {
                  "start": 12,
                  "end": 14
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
