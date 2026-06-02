===source===
<?php
/** @var string[] $items */
foreach ($items as $item) {
    echo $item;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "items"
            },
            "span": {
              "start": 43,
              "end": 49
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "item"
            },
            "span": {
              "start": 53,
              "end": 58
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Variable": "item"
                        },
                        "span": {
                          "start": 71,
                          "end": 76
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 66,
                    "end": 77
                  }
                }
              ]
            },
            "span": {
              "start": 60,
              "end": 79
            }
          }
        }
      },
      "span": {
        "start": 34,
        "end": 79
      },
      "doc_comment": {
        "kind": "Doc",
        "text": "/** @var string[] $items */",
        "span": {
          "start": 6,
          "end": 33
        }
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 79
  }
}
