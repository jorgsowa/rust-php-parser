===source===
<?php if (isset($a, $b, $c)) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Isset": [
                {
                  "kind": {
                    "Variable": "a"
                  },
                  "span": {
                    "start": 16,
                    "end": 18
                  }
                },
                {
                  "kind": {
                    "Variable": "b"
                  },
                  "span": {
                    "start": 20,
                    "end": 22
                  }
                },
                {
                  "kind": {
                    "Variable": "c"
                  },
                  "span": {
                    "start": 24,
                    "end": 26
                  }
                }
              ]
            },
            "span": {
              "start": 10,
              "end": 27
            }
          },
          "then_branch": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 29,
              "end": 31
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
