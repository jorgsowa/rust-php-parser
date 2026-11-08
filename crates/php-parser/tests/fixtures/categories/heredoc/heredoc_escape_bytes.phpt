===source===
<?php <<<EOT
\xfe\x01
EOT;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Heredoc": {
              "label": "EOT",
              "parts": [
                {
                  "Literal": {
                    "bytes": [
                      254,
                      1
                    ]
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
