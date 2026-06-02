===source===
<?php
/** doc 1 — stays in ParseResult::comments */
/** doc 2 — attaches to the statement */
$x = compute();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 97,
                  "end": 99
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Identifier": "compute"
                      },
                      "span": {
                        "start": 102,
                        "end": 109
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 102,
                  "end": 111
                }
              }
            }
          },
          "span": {
            "start": 97,
            "end": 111
          }
        }
      },
      "span": {
        "start": 97,
        "end": 112
      },
      "doc_comment": {
        "kind": "Doc",
        "text": "/** doc 2 — attaches to the statement */",
        "span": {
          "start": 54,
          "end": 96
        }
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 112
  }
}
