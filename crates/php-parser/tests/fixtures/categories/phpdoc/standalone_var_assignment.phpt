===source===
<?php
/** @var int|string $result */
$result = compute();
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
                  "Variable": "result"
                },
                "span": {
                  "start": 37,
                  "end": 44
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
                        "start": 47,
                        "end": 54
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 47,
                  "end": 56
                }
              }
            }
          },
          "span": {
            "start": 37,
            "end": 56
          }
        }
      },
      "span": {
        "start": 37,
        "end": 57
      },
      "doc_comment": {
        "kind": "Doc",
        "text": "/** @var int|string $result */",
        "span": {
          "start": 6,
          "end": 36
        }
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 57
  }
}
