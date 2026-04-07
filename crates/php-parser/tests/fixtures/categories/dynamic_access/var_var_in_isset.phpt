===source===
<?php isset($$name);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Isset": [
              {
                "kind": {
                  "VariableVariable": {
                    "kind": {
                      "Variable": "name"
                    },
                    "span": {
                      "start": 13,
                      "end": 18
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 18
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
