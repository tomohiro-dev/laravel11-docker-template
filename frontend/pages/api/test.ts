import axios from "axios";
import type { NextApiRequest, NextApiResponse } from 'next';

export default async function handler(
  req: NextApiRequest,
  res: NextApiResponse
) {
  try {
    // localhost経由でLaravel APIを呼び出す
    // app サービスのポートが8000
    const response = await axios.get("http://app:8000/api/test");
    res.status(200).json(response.data);
  } catch (error) {
    if (error instanceof Error) {
      res.status(500).json({ error: error.message });
    } else {
      res.status(500).json({ error: '不明なエラーが発生しました' });
    }
  }
}